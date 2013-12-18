<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="94" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_reg_dtl_ppjForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_vat_reg_dtl_ppjForm" activeCollection="DSQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customInsert="INSERT INTO t_vat_reg_dtl_ppj(t_vat_reg_dtl_ppj_id, created_by, updated_by, creation_date, updated_date, t_vat_registration_id, service_charge, power_factor, description, power_capacity, pwr_classification_desc, p_pwr_classification_id, is_pln) 
VALUES(generate_id('sikp','t_vat_reg_dtl_ppj','t_vat_reg_dtl_ppj_id'), '{created_by}', '{updated_by}', sysdate, sysdate, {t_vat_registration_id}, '{service_charge}', {power_factor}, '{description}', {power_capacity}, '{pwr_classification_desc}', {p_pwr_classification_id}, 'Y')" customUpdate="UPDATE t_vat_reg_dtl_ppj SET 
updated_by='{updated_by}', 
updated_date=sysdate, 
t_vat_registration_id={t_vat_registration_id}, 
service_charge='{service_charge}', 
power_factor={power_factor}, 
description='{description}', 
power_capacity={power_capacity}, 
pwr_classification_desc='{pwr_classification_desc}', 
p_pwr_classification_id={p_pwr_classification_id} 
WHERE t_vat_reg_dtl_ppj_id={t_vat_reg_dtl_ppj_id}" customDelete="DELETE FROM t_vat_reg_dtl_ppj
WHERE t_vat_reg_dtl_ppj_id = {t_vat_reg_dtl_ppj_id}" dataSource="v_vat_reg_dtl_ppj" activeTableType="t_vat_reg_dtl_ppj">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_vat_reg_dtl_ppjFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_vat_reg_dtl_ppjFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_vat_reg_dtl_ppjFormButton_Delete" removeParameters="FLAG;t_vat_reg_dtl_ppj_id">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="98" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_vat_reg_dtl_ppjFormButton_Cancel" removeParameters="FLAG;t_vat_reg_dtl_ppj_id">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="673" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_ppjFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_ppjFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_ppjFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_ppjFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="619" fieldSourceType="DBColumn" dataType="Float" name="t_vat_registration_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_ppjFormt_vat_registration_id" fieldSource="t_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="677" fieldSourceType="DBColumn" dataType="Text" html="False" name="rqst_type_code" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjFormrqst_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="692" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="service_charge" fieldSource="service_charge" required="True" caption="Harga Satuan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_ppjFormservice_charge">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="694" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="power_factor" fieldSource="power_factor" required="True" caption="Faktor Daya" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_ppjFormpower_factor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="753" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Keterangan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_ppjFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="757" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="power_capacity" fieldSource="power_capacity" required="True" caption="Kapasitas Daya" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_ppjFormpower_capacity" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="758" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="pwr_classification_desc" fieldSource="pwr_classification_desc" required="True" caption="Golongan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_ppjFormpwr_classification_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="759" fieldSourceType="DBColumn" dataType="Float" name="p_pwr_classification_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_ppjFormp_pwr_classification_id" fieldSource="p_pwr_classification_id" caption="p_pwr_classification_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="821" fieldSourceType="DBColumn" dataType="Float" name="t_vat_reg_dtl_ppj_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_ppjFormt_vat_reg_dtl_ppj_id" fieldSource="t_vat_reg_dtl_ppj_id" caption="t_vat_reg_dtl_ppj_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="678" fieldSourceType="DBColumn" dataType="Float" name="p_rqst_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_ppjFormp_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="679" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_ppjFormt_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="872" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="873" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="874" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="823" conditionType="Parameter" useIsNull="False" field="t_vat_reg_dtl_ppj_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_reg_dtl_ppj_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="822" tableName="v_vat_reg_dtl_ppj" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters>
				<SPParameter id="Key176" parameterName="i_p_app_user_id" parameterSource="0" dataType="Numeric" parameterType="Expression" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key178" parameterName="i_full_name" parameterSource="full_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key179" parameterName="i_email_address" parameterSource="email_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key181" parameterName="i_p_data_status_list_id" parameterSource="p_data_status_list_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key182" parameterName="i_p_region_id" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key184" parameterName="i_description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key185" parameterName="i_ip_address" parameterSource="ip_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key187" parameterName="i_expired_pwd" parameterSource="expired_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key188" parameterName="i_user_by" parameterSource="UserName" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
				<SQLParameter id="836" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="837" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="840" variable="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<SQLParameter id="841" variable="service_charge" dataType="Text" parameterType="Control" parameterSource="service_charge"/>
				<SQLParameter id="842" variable="power_factor" dataType="Float" parameterType="Control" parameterSource="power_factor"/>
				<SQLParameter id="843" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="844" variable="power_capacity" dataType="Float" parameterType="Control" parameterSource="power_capacity"/>
				<SQLParameter id="845" variable="pwr_classification_desc" dataType="Text" parameterType="Control" parameterSource="pwr_classification_desc"/>
				<SQLParameter id="846" variable="p_pwr_classification_id" dataType="Float" parameterType="Control" parameterSource="p_pwr_classification_id"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="824" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="825" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="826" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="827" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="828" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<CustomParameter id="829" field="service_charge" dataType="Text" parameterType="Control" parameterSource="service_charge"/>
				<CustomParameter id="830" field="power_factor" dataType="Float" parameterType="Control" parameterSource="power_factor"/>
				<CustomParameter id="831" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="832" field="power_capacity" dataType="Float" parameterType="Control" parameterSource="power_capacity"/>
				<CustomParameter id="833" field="pwr_classification_desc" dataType="Text" parameterType="Control" parameterSource="pwr_classification_desc"/>
				<CustomParameter id="834" field="p_pwr_classification_id" dataType="Float" parameterType="Control" parameterSource="p_pwr_classification_id"/>
				<CustomParameter id="835" field="t_vat_reg_dtl_ppj_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_ppj_id"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="Key154" parameterName="i_flag" parameterSource="2" dataType="Numeric" parameterType="Expression" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key155" parameterName="i_p_app_user_id" parameterSource="p_app_user_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key156" parameterName="i_user_name" parameterSource="user_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key157" parameterName="i_full_name" parameterSource="full_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key158" parameterName="i_email_address" parameterSource="email_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key159" parameterName="i_p_user_type_id" parameterSource="p_user_type_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key160" parameterName="i_p_data_status_list_id" parameterSource="p_data_status_list_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key161" parameterName="i_p_region_id" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key162" parameterName="i_p_region_structure_id" parameterSource="p_region_structure_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key163" parameterName="i_description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key164" parameterName="i_ip_address" parameterSource="ip_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key165" parameterName="i_expired_user" parameterSource="expired_user" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key166" parameterName="i_expired_pwd" parameterSource="expired_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key167" parameterName="i_user_by" parameterSource="UserName" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
			</USPParameters>
			<USQLParameters>
				<SQLParameter id="860" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="863" variable="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<SQLParameter id="864" variable="service_charge" dataType="Text" parameterType="Control" parameterSource="service_charge"/>
				<SQLParameter id="865" variable="power_factor" dataType="Float" parameterType="Control" parameterSource="power_factor"/>
				<SQLParameter id="866" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="867" variable="power_capacity" dataType="Float" parameterType="Control" parameterSource="power_capacity"/>
				<SQLParameter id="868" variable="pwr_classification_desc" dataType="Text" parameterType="Control" parameterSource="pwr_classification_desc"/>
				<SQLParameter id="869" variable="p_pwr_classification_id" dataType="Float" parameterType="Control" parameterSource="p_pwr_classification_id"/>
				<SQLParameter id="870" variable="t_vat_reg_dtl_ppj_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_ppj_id"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="847" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="848" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="849" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="850" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="851" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<CustomParameter id="852" field="service_charge" dataType="Text" parameterType="Control" parameterSource="service_charge"/>
				<CustomParameter id="853" field="power_factor" dataType="Float" parameterType="Control" parameterSource="power_factor"/>
				<CustomParameter id="854" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="855" field="power_capacity" dataType="Float" parameterType="Control" parameterSource="power_capacity"/>
				<CustomParameter id="856" field="pwr_classification_desc" dataType="Text" parameterType="Control" parameterSource="pwr_classification_desc"/>
				<CustomParameter id="857" field="p_pwr_classification_id" dataType="Float" parameterType="Control" parameterSource="p_pwr_classification_id"/>
				<CustomParameter id="858" field="t_vat_reg_dtl_ppj_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_ppj_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="871" variable="t_vat_reg_dtl_ppj_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_vat_reg_dtl_ppj_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_reg_dtl_ppj_edit_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_reg_dtl_ppj_edit.php" forShow="True" url="t_vat_reg_dtl_ppj_edit.php" comment="//" codePage="windows-1252"/>
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
