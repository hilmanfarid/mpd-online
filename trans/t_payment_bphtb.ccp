<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_setllementForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="t_vat_setllementForm" activeCollection="ISQLParameters" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsertType="SQL" activeTableType="customUpdate" customInsert="SELECT * FROM f_payment_bphtb('{no_reg}',{nilai_pembayaran}, '1', '1', '{bit48}', null);" dataSource="SELECT * 
FROM t_bphtb_registration">
			<Components>
				<TextBox id="174" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="no_registrasi" PathID="t_vat_setllementFormno_registrasi">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextArea id="175" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="TextArea1" PathID="t_vat_setllementFormTextArea1">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextArea>
<Label id="176" fieldSourceType="DBColumn" dataType="Text" html="True" name="LabelBayar" PathID="t_vat_setllementFormLabelBayar" fieldSource="LabelBayar">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Hidden id="177" fieldSourceType="DBColumn" dataType="Text" name="bit48" PathID="t_vat_setllementFormbit48" fieldSource="bit48">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="178" fieldSourceType="DBColumn" dataType="Integer" name="nilai_pembayaran" PathID="t_vat_setllementFormnilai_pembayaran" fieldSource="nilai_pembayaran">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Label id="180" fieldSourceType="DBColumn" dataType="Text" html="True" name="Label1" PathID="t_vat_setllementFormLabel1" fieldSource="Label1">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Button id="164" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_vat_setllementFormButton1">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="165" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
<Button id="181" urlType="Relative" enableValidation="True" isDefault="False" name="BtnBayar" PathID="t_vat_setllementFormBtnBayar" operation="Insert">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Hidden id="185" fieldSourceType="DBColumn" dataType="Text" name="no_reg" PathID="t_vat_setllementFormno_reg" fieldSource="no_reg">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="179"/>
</Actions>
</Event>
<Event name="AfterInsert" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="186"/>
</Actions>
</Event>
</Events>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="187" tableName="chatting" schemaName="sikp" posLeft="10" posTop="10" posWidth="95" posHeight="136"/>
</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="182" variable="bit48" parameterType="Control" dataType="Text" parameterSource="bit48"/>
<SQLParameter id="183" variable="no_reg" parameterType="Control" dataType="Text" parameterSource="no_reg"/>
<SQLParameter id="184" variable="nilai_pembayaran" parameterType="Control" dataType="Text" parameterSource="nilai_pembayaran"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="133" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id"/>
				<CustomParameter id="134" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="135" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="136" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="137" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="138" field="to_char(updated_date,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="139" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
			</USQLParameters>
			<UConditions>
				<TableParameter id="126" conditionType="Parameter" useIsNull="False" field="p_rqst_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_rqst_type_id"/>
				<TableParameter id="127" conditionType="Parameter" useIsNull="False" field="p_rqst_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="p_rqst_type_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="49" field="code" dataType="Text" parameterType="Control" parameterSource="code" omitIfEmpty="True"/>
				<CustomParameter id="53" field="description" dataType="Text" parameterType="Control" parameterSource="description" omitIfEmpty="True"/>
				<CustomParameter id="56" field="updated_date" dataType="Date" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="57" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by" omitIfEmpty="True"/>
				<CustomParameter id="69" field="creation_date" dataType="Date" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="70" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by" omitIfEmpty="True"/>
				<CustomParameter id="125" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id" omitIfEmpty="True"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="132" conditionType="Parameter" useIsNull="False" field="p_rqst_type_id" dataType="Float" parameterType="URL" parameterSource="p_rqst_type_id" searchConditionType="Equal" logicOperator="And"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_payment_bphtb_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_payment_bphtb.php" forShow="True" url="t_payment_bphtb.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
	</Events>
</Page>
