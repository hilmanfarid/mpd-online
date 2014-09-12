<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\lov" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="lov_submitter_start.ccp" pasteActions="pasteActions" isInDroping="true">
	<Components>
		<Record id="82" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="V_SUBMITTER" actionPage="lov_submitter_start" errorSummator="Error" wizardFormMethod="post" PathID="V_SUBMITTER" pasteActions="pasteActions" connection="ConnSIKP" activeCollection="TableParameters" pasteAsReplace="pasteAsReplace" dataSource="submitter">
			<Components>
				<Button id="85" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" PathID="V_SUBMITTERButton_Update" wizardCaption="SIMPAN">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="101" eventType="Server" id_oncopy="101"/>
							</Actions>
						</Event>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="103" message="Anda yakin akan menutup pekerjaan ini ?" eventType="Client" id_oncopy="103"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="86" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" PathID="V_SUBMITTERButton_Delete" wizardCaption="HAPUS">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="87" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SUBMIT_DATE" fieldSource="submit_date" required="False" caption="SUBMIT_DATE" wizardCaption="CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERSUBMIT_DATE" format="dd-mmm-yyyy H:nn:ss" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="91" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="INTERACTIVE_MESSAGE" PathID="V_SUBMITTERINTERACTIVE_MESSAGE" caption="INTERACTIVE_MESSAGE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="93" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SENT_MESSAGE" PathID="V_SUBMITTERSENT_MESSAGE" fieldSource="error_message" caption="SENT_MESSAGE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="95" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ERROR_MESSAGE" PathID="V_SUBMITTERERROR_MESSAGE" fieldSource="error_message" caption="ERROR_MESSAGE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="97" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="WARNING" PathID="V_SUBMITTERWARNING" fieldSource="warning" caption="WARNING">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="113" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="CURR_DOC_ID" required="False" caption="CURR_DOC_ID" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERCURR_DOC_ID" defaultValue="CCGetRequestParam(&quot;CURR_DOC_ID&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="CURR_DOC_TYPE_ID" required="False" caption="CURR_DOC_TYPE_ID" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERCURR_DOC_TYPE_ID" defaultValue="CCGetRequestParam(&quot;CURR_DOC_TYPE_ID&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="115" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="CURR_PROC_ID" required="False" caption="CURR_PROC_ID" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERCURR_PROC_ID" defaultValue="CCGetRequestParam(&quot;CURR_PROC_ID&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="116" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="CURR_CTL_ID" required="False" caption="CURR_CTL_ID" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERCURR_CTL_ID" defaultValue="CCGetRequestParam(&quot;CURR_CTL_ID&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="117" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="PREV_DOC_ID" required="False" caption="PREV_DOC_ID" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERPREV_DOC_ID" defaultValue="CCGetRequestParam(&quot;PREV_PROC_ID&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="118" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="PREV_DOC_TYPE_ID" required="False" caption="PREV_DOC_TYPE_ID" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERPREV_DOC_TYPE_ID" defaultValue="CCGetRequestParam(&quot;PREV_DOC_TYPE_ID&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="119" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="PREV_PROC_ID" required="False" caption="PREV_PROC_ID" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERPREV_PROC_ID" defaultValue="CCGetRequestParam(&quot;PREV_PROC_ID&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="120" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="PREV_CTL_ID" required="False" caption="PREV_CTL_ID" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERPREV_CTL_ID" defaultValue="CCGetRequestParam(&quot;PREV_CTL_ID&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="121" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SLOT_1" required="False" caption="SLOT_1" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERSLOT_1" defaultValue="CCGetRequestParam(&quot;SLOT_1&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SLOT_2" required="False" caption="SLOT_2" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERSLOT_2" defaultValue="CCGetRequestParam(&quot;SLOT_2&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="123" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SLOT_3" required="False" caption="SLOT_3" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERSLOT_3" defaultValue="CCGetRequestParam(&quot;SLOT_3&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SLOT_4" required="False" caption="SLOT_4" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERSLOT_4" defaultValue="CCGetRequestParam(&quot;SLOT_4&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SLOT_5" required="False" caption="SLOT_5" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERSLOT_5" defaultValue="CCGetRequestParam(&quot;SLOT_5&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="126" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="USER_ID_DOC" required="False" caption="USER_ID_DOC" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERUSER_ID_DOC" defaultValue="CCGetRequestParam(&quot;USER_ID_DOC&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="USER_ID_DONOR" required="False" caption="USER_ID_DONOR" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERUSER_ID_DONOR" defaultValue="CCGetRequestParam(&quot;USER_ID_DONOR&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="128" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="USER_ID_LOGIN" required="False" caption="USER_ID_LOGIN" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERUSER_ID_LOGIN" defaultValue="CCGetUserID()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="129" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="USER_ID_TAKEN" required="False" caption="USER_ID_TAKEN" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERUSER_ID_TAKEN" defaultValue="CCGetRequestParam(&quot;USER_ID_TAKEN&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="130" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="IS_CREATE_DOC" required="False" caption="IS_CREATE_DOC" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERIS_CREATE_DOC" defaultValue="CCGetRequestParam(&quot;IS_CREATE_DOC&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="131" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="IS_MANUAL" required="False" caption="IS_MANUAL" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERIS_MANUAL" defaultValue="CCGetRequestParam(&quot;IS_MANUAL&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="132" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_STATUS" required="False" caption="CURR_PROC_STATUS" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERCURR_PROC_STATUS" defaultValue="CCGetRequestParam(&quot;CURR_PROC_STATUS&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="133" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_STATUS" required="False" caption="CURR_DOC_STATUS" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERCURR_DOC_STATUS" defaultValue="CCGetRequestParam(&quot;CURR_DOC_STATUS&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="134" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="MESSAGE" required="False" caption="MESSAGE" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERMESSAGE" defaultValue="CCGetRequestParam(&quot;MESSAGE&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="135" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="IS_VIEW_ONLY" required="False" caption="IS_VIEW_ONLY" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERIS_VIEW_ONLY" defaultValue="CCGetRequestParam(&quot;IS_VIEW_ONLY&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="136" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="JENIS" required="False" caption="JENIS" wizardCaption="T CUSTOMER REQUEST ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="V_SUBMITTERJENIS" defaultValue="CCGetRequestParam(&quot;JENIS&quot;, ccsGet, NULL)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="100" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="RETURN_MESSAGE" PathID="V_SUBMITTERRETURN_MESSAGE" fieldSource="return_message" caption="RETURN_MESSAGE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="137" fieldSourceType="DBColumn" dataType="Text" html="False" name="lusername" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="V_SUBMITTERlusername" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="98" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="SUBMITTER_ID" PathID="V_SUBMITTERSUBMITTER_ID" fieldSource="submitter_id" caption="SUBMITTER_ID" defaultValue="-99999">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="142" fieldSourceType="DBColumn" dataType="Text" html="True" name="NTASK" PathID="V_SUBMITTERNTASK">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="143" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Float" returnValueType="Number" name="STS" wizardEmptyCaption="Select Value" PathID="V_SUBMITTERSTS" connection="ConnSIKP" dataSource="select p_status_list_id, code 
from v_document_workflow_status" activeCollection="TableParameters" boundColumn="p_status_list_id" textColumn="code" required="False" caption="STS">
					<Components/>
					<Events/>
					<TableParameters>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Button id="144" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Reject" PathID="V_SUBMITTERButton_Reject" wizardCaption="SIMPAN">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="145" eventType="Server" id_oncopy="145"/>
							</Actions>
						</Event>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="146" message="Anda yakin akan menutup pekerjaan ini ?" eventType="Client" id_oncopy="146"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
<Button id="147" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Back" PathID="V_SUBMITTERButton_Back" wizardCaption="SIMPAN">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="148" id_oncopy="148"/>
							</Actions>
						</Event>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="149" message="Anda yakin akan menutup pekerjaan ini ?" id_oncopy="149"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="111" id_oncopy="111"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="48" conditionType="Parameter" useIsNull="False" field="submitter_id" dataType="Float" searchConditionType="Equal" parameterType="Form" logicOperator="And" defaultValue="-99999" parameterSource="V_SUBMITTERSUBMITTER_ID"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="49" tableName="submitter" posLeft="10" posTop="10" posWidth="156" posHeight="180"/>
			</JoinTables>
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
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="lov_submitter_start_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="lov_submitter_start.php" forShow="True" url="lov_submitter_start.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
