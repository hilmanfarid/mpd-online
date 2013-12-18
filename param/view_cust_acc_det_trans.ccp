<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="VIEWCUSDETTRANS" wizardCaption="Search P CUSTOMER SEGMENT " wizardOrientation="Horizontal" wizardFormMethod="post" returnPage="view_cust_acc_det_trans.ccp" PathID="VIEWCUSDETTRANS" pasteActions="pasteActions" connection="ConnSIKP">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="VIEWCUSDETTRANSs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="VIEWCUSDETTRANSButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" name="VIEWDETTRANS" connection="ConnSIKP" dataSource="SELECT * FROM t_cust_acc_dtl_trans
WHERE t_cust_account_id = {t_cust_account_id}
AND bill_no ILIKE '%{s_keyword}%'" pageSizeLimit="100" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" pasteActions="pasteActions">
<Components>
<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="trans_date" fieldSource="trans_date" PathID="VIEWDETTRANStrans_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Navigator id="17" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Navigator>
<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="bill_no" fieldSource="bill_no" PathID="VIEWDETTRANSbill_no">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="46" fieldSourceType="DBColumn" dataType="Text" html="False" name="service_desc" fieldSource="service_desc" PathID="VIEWDETTRANSservice_desc">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="47" fieldSourceType="DBColumn" dataType="Text" html="False" name="service_charge" fieldSource="service_charge" PathID="VIEWDETTRANSservice_charge">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_charge" fieldSource="vat_charge" PathID="VIEWDETTRANSvat_charge">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="49" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" name="npwd" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="VIEWDETTRANSnpwd" html="False">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="50" fieldSourceType="CodeExpression" dataType="Text" html="False" name="vat_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="VIEWDETTRANSvat_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events>
<Event name="BeforeSelect" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="39"/>
</Actions>
</Event>
<Event name="BeforeShowRow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="40"/>
</Actions>
</Event>
</Events>
<TableParameters>
<TableParameter id="34" conditionType="Parameter" useIsNull="False" field="p_region_level_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" parameterSource="3" logicOperator="Or" leftBrackets="1"/>
<TableParameter id="38" conditionType="Parameter" useIsNull="False" field="p_region_level_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" parameterSource="4" logicOperator="And" rightBrackets="1"/>
<TableParameter id="36" conditionType="Parameter" useIsNull="False" field="upper(region_name)" dataType="Text" searchConditionType="Contains" parameterType="URL" parameterSource="s_keyword" logicOperator="Or" leftBrackets="1"/>
<TableParameter id="37" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" searchConditionType="Contains" parameterType="URL" parameterSource="s_keyword" logicOperator="And" rightBrackets="1"/>
</TableParameters>
<JoinTables/>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="44" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
<SQLParameter id="45" variable="t_cust_account_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="t_cust_account_id"/>
</SQLParameters>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="view_cust_acc_det_trans_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="view_cust_acc_det_trans.php" forShow="True" url="view_cust_acc_det_trans.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
